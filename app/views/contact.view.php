<?php
view("parts/header", ['title' => 'Contact']);
view("parts/navigatie-menu");

// Assuming $user contains the logged-in user's data
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null; // Replace with actual function to get user data
?>
    <div class="sm:mx-10">
        <h1 class="text-3xl my-4">Contact</h1>
        <?php if ($user): ?>
        <div class="text-center">
            <a href="/berichten-klant" class="bg-[#52EBEB] text-white rounded-md px-4 py-2 hover:bg-[#3BBDBD]">Mijn Berichten</a>
        </div>
        <?php endif; ?>
    </div>

    <?php if (isset($_SESSION['flash_message']) && isset($_SESSION['flash_message_type']) && $_SESSION['flash_message_type'] === 'contact'): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline"><?php echo $_SESSION['flash_message']; ?></span>
        </div>
        <?php unset($_SESSION['flash_message']); unset($_SESSION['flash_message_type']); ?>
    <?php endif; ?>

    <form action="/contact" method="post" class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md space-y-4">
        <?= csrf() ?>
        <input type="hidden" name="message_id" value="<?= htmlspecialchars($message['id'] ?? '') ?>">
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Naam</label>
            <input type="text" id="name" name="name" placeholder="Vul je naam in" value="<?php echo !empty($user['name']) ? $user['name'] : ''; ?>" class="border border-gray-300 rounded-md p-2 w-full" required>
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
            <input type="submit" value="Verstuur" name="save" class="bg-[#52EBEB] text-white rounded-md px-4 py-2 hover:bg-[#3BBDBD] cursor-pointer">
        </div>
    </form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    // Assuming $db is the database connection and $query, $params are defined
    if ($db->query($query, $params)) {
        $_SESSION['flash_message'] = "Bericht succesvol verstuurd!";
        $_SESSION['flash_message_type'] = 'contact';
    }
    header("Location: /contact");
    exit;
}
view("parts/footer");
?>