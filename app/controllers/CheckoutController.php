class CheckoutController {
    // ...existing code...

    public function applyDiscount() {
        $kortingscode = $_POST['kortingscode'] ?? '';

        if (!empty($kortingscode)) {
            $database = new Database();
            $kortingscodeData = $database->query('SELECT * FROM kortingcodes WHERE code = ?', [$kortingscode])->fetch();
            if ($kortingscodeData) {
                $_SESSION['kortingscode'] = $kortingscodeData;
            } else {
                $_SESSION['error'] = 'Ongeldige kortingscode';
            }
        }

        header('Location: /checkout');
        exit;
    }

    // ...existing code...
}
