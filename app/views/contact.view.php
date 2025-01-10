<?php
view("parts/header", ['title' => 'contact']);
view("parts/navigatie-menu");
?>
    <div class="sm:mx-10">
        <h1 class="text-3xl my-4">Contact</h1>
    </div>

    <form action="/contact" method="post" style="text-align: center;">
        <?= csrf() ?>
        <input type="text" name="name" placeholder="Vul je naam in" value="<?php echo !empty($postData['name']) ? $postData['name'] : ''; ?>" required> <br><br>
        
        <input type="email" name="email" placeholder="Vul je email in" value="<?php echo !empty($postData['email']) ? $postData['email'] : ''; ?>" required> <br><br>
        
        <input type="text" name="subject" placeholder="Onderwerp" value="<?php echo !empty($postData['subject']) ? $postData['subject'] : ''; ?>" required> <br><br>
        
        <textarea name="message" placeholder="Bericht" required><?php echo !empty($postData['message']) ? $postData['message'] : ''; ?></textarea> <br><br>
        
        <input type="submit" value="Verstuur" name="save" class="border border-1 rounded-md px-2 py-1 hover:bg-gray-100 cursor-pointer">
    </form>

<?php
view("parts/footer");
?>