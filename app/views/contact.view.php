<?php
view("parts/header", ['title' => 'Contact']);
view("parts/navigatie-menu");
?>
    <div class="sm:mx-10">
        <h1 class="text-3xl my-4">Contact</h1>
    </div>

    <form action="/contact" method="post" class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md space-y-4">
        <?= csrf() ?>
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Naam</label>
            <input type="text" id="name" name="name" placeholder="Vul je naam in" value="<?php echo !empty($postData['name']) ? $postData['name'] : ''; ?>" class="border border-gray-300 rounded-md p-2 w-full" required>
        </div>
        
        <div class="mb-4">
            <label for="subject" class="block text-gray-700">Onderwerp</label>
            <input type="text" id="subject" name="subject" placeholder="Onderwerp" value="<?php echo !empty($postData['subject']) ? $postData['subject'] : ''; ?>" class="border border-gray-300 rounded-md p-2 w-full" required>
        </div>
        
        <div class="mb-4">
            <label for="message" class="block text-gray-700">Bericht</label>
            <textarea id="message" name="message" placeholder="Bericht" class="border border-gray-300 rounded-md p-2 w-full" required><?php echo !empty($postData['message']) ? $postData['message'] : ''; ?></textarea>
        </div>
        
        <div class="text-center">
            <input type="submit" value="Verstuur" name="save" class="bg-blue-500 text-white rounded-md px-4 py-2 hover:bg-blue-600 cursor-pointer">
        </div>
    </form>

<?php
view("parts/footer");
?>