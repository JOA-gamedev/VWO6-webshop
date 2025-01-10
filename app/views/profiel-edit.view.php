<?php
view("parts/header", ['title' => 'gegevens-edit']);
view("parts/navigatie-menu");
?>
    <div class="sm:mx-10">
        <h1 class="text-3xl my-4">Uw gegevens wijzigen</h1>
        <p>
        <form action="/posts" method="post" style="text-align: center;">
        <?= csrf() ?>
        <input type="text" name="title" placeholder="Naam"> <br> <br>
        <input type="email" name="email" placeholder="Email"> <br> <br>
        <input type="text" name="phonenumber" placeholder="Telefoonnummer"> <br> <br>
        <input type="text" name="place" placeholder="Plaatsnaam"> <br> <br>
        <input type="text" name="adres" placeholder="Huisnummer"> <br> <br>
        <input type="text" name="postcode" placeholder="Postcode"> <br> <br>
        <textarea name="content" placeholder="Content"></textarea> <br> <br>
        <input type="submit" value="Opslaan">
    </form>
        </p>
    </div>
<?php
view("parts/footer");