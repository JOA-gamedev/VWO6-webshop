<?php

class Model
{
    //Private parameters zijn kan je alleen binnen het object gebruiken
    private $query_log = [];
    private $query = '';
    private $bind_params = [];
    private $limit = '';
    private $where = [];
    private $original = [];
    //deze kan je overschrijven in je child class
    protected $table = '';
    protected $primaryKey = 'id';

    //ophalen van één object dmv de primaire sleutel
    public function find($id): self
    {
        $db = new Database();
        $this->setQuery("SELECT * FROM {$this->getTable()} WHERE `{$this->primaryKey}` = ?");
        $this->original = $db->query($this->query, [$id])->fetch();
        if ($this->original) {
            foreach ($this->original as $k => $v) {
                $this->$k = $v;
            }
        } else {
            echo "id=$id not found";
            die();
        }
        return $this;
    }

    //Object opslaan in de database
    public function save(): self
    {
        if ($this->original[$this->primaryKey]) {
            $db = new Database();
            $update = [];
            $cols = [];
            foreach ($this->original as $k => $v) {
                if ($this->$k != $v) {
                    $cols[] = "`$k` = ?";
                    $update[] = $this->$k;
                }
            }
            if (!empty($cols)) {
                $update[] = $this->original[$this->primaryKey];
                $this->setQuery("UPDATE {$this->getTable()} SET " .
                    implode(",", $cols) .
                    " WHERE `{$this->primaryKey}`=?"
                );
                $db->query($this->query, $update);
                $this->find($this->original[$this->primaryKey]);
            }
        }
        return $this;
    }

    //nieuw object aanmaken (en opslaan in de database)
    public function create($array): self
    {
        $placeholders = [];
        $cols = [];
        $values = [];
        foreach ($array as $k => $v) {
            $cols[] = "`" . $k . "`";
            $values[] = $v;
            $placeholders[] = " ?";
        }
        if (!empty($cols)) {
            $db = new Database();
            $this->setQuery("INSERT INTO {$this->getTable()} (" . implode(",", $cols) . ") " .
                "VALUES (" . implode(",", $placeholders) . ")");
            $db->query($this->query, $values);
            $id = $db->lastInsertId();
            $this->find($id);
        }
        return $this;
    }

    //Object verwijderen
    public function delete()
    {
        if ($this->original[$this->primaryKey]) {
            $db = new Database();
            $this->setQuery("DELETE FROM {$this->getTable()} WHERE `{$this->primaryKey}` = ?");
            $db->query($this->query, [$this->original[$this->primaryKey]]);
            $this->destruct();
        }
        return null;
    }

    //alle objecten ophalen
    public function all()
    {
        $db = new Database();
        $this->setQuery("SELECT * FROM {$this->getTable()}");
        return $db->query($this->query)->fetchAll();
    }

    //bouwen van een query op de betreffende tabel
    public function where(...$args): self
    {
        if (!isset($args[2])) {
            $value = $args[1];
            $operator = "=";
        } else {
            $value = $args[2];
            $operator = $args[1];
        }
        $this->where[] = ['column' => $args[0], 'value' => $value, 'operator' => $operator];
        return $this;
    }

    //bouwen van een query op de betreffende tabel
    public function whereNull($col): self
    {
        $this->where[] = ['column' => $col, 'operator' => ' IS NULL'];
        return $this;
    }

    //bouwen van een query op de betreffende tabel
    public function whereNotNull($col): self
    {
        $this->where[] = ['column' => $col, 'operator' => ' IS NOT NULL'];
        return $this;
    }

    public function limit(...$args): self
    {
        if (isset($args[1])) {
            $this->limit = " LIMIT {$args[0]},{$args[1]}";
        } else {
            $this->limit = " LIMIT {$args[0]}";
        }
        return $this;
    }

    //Werkelijk uitvoeren van de query
    public function get(): array
    {
        $this->buildQuery();
        $db = new Database();
        return $db->query($this->query, $this->bind_params)->fetchAll();
    }

    //in plaats van get() kan je deze gebruiken om de query te dumpen i.p.v. uitvoeren
    public function dumpQuery(): void
    {
        $this->buildQuery();
        dd($this->query);
    }

    //alle uitgevoerde queries dumpen
    public function dumpQueryLog(): void
    {
        dd($this->query_log);
    }

    //niets mee doen
    protected function getTable(): string
    {
        return $this->table ?? rtrim(strtolower(get_class($this)), "s");
    }

    //om een query log op te bouwen (wordt intern gebruikt)
    private function setQuery($query)
    {
        $this->query = $query;
        $this->query_log[] = $query;
    }

    //bouwen van een query aan de hand van where
    private function buildQuery(): void
    {
        $where = [];
        $this->bind_params = [];
        foreach ($this->where as $v) {
            $where[] = "`{$v['column']}` {$v['operator']}" . (isset($v['value']) ? ' ?' : '');
            if ($v['value'] ?? null) {
                $this->bind_params[] = $v['value'];
            }
        }
        $this->setQuery("SELECT * FROM {$this->getTable()} " .
            (!empty($where) ? ' WHERE ' . implode(" AND ", $where) : '') .
            $this->limit
        );
    }

    //object leegmaken
    private function destruct(): void
    {
        foreach ($this->original as $k => $v) {
            unset($this->$k);
        }
        $this->original = [];
    }
}