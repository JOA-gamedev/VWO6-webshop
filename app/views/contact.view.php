<?php
view("parts/header", ['title' => 'contact']);
view("parts/navigatie-menu");
?>
    <div class="sm:mx-10">
        <h1 class="text-3xl my-4">Contact</h1>
    </div>

    <form action="/contact" method="post" class="text-center space-y-4">
        <?= csrf() ?>
        <input type="text" name="name" placeholder="Vul je naam in" value="<?php echo !empty($postData['name']) ? $postData['name'] : ''; ?>" class="border border-gray-300 rounded-md p-2 w-full" required> <br>
        
        <input type="email" name="email" placeholder="Vul je email in" value="<?php echo !empty($postData['email']) ? $postData['email'] : ''; ?>" class="border border-gray-300 rounded-md p-2 w-full" required> <br>
        
        <input type="text" name="subject" placeholder="Onderwerp" value="<?php echo !empty($postData['subject']) ? $postData['subject'] : ''; ?>" class="border border-gray-300 rounded-md p-2 w-full" required> <br>
        
        <textarea name="message" placeholder="Bericht" class="border border-gray-300 rounded-md p-2 w-full" required><?php echo !empty($postData['message']) ? $postData['message'] : ''; ?></textarea> <br>
        
        <input type="submit" value="Verstuur" name="save" class="border border-gray-300 rounded-md px-4 py-2 hover:bg-gray-100 cursor-pointer">
    </form>

<?php
view("parts/footer");
?>