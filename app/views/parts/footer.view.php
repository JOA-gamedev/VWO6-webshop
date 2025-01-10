<!-- indien er een flash message is -->
<?php if ($_SESSION['flash'] ?? false): ?>
    <div x-data="{ nofifiction: true }"
         x-init="setTimeout(function(){ nofifiction=false; }, <?= $_SESSION['flash']['duration']; ?>)"
         class="fixed top-12 w-5/6 ml-6 z-20">
        <div x-show="nofifiction"
             x-transition
             class="flex items-center justify-between gap-6 p-4 w-full bg-white border rounded-md shadow-sm <?= ($_SESSION['flash']['error'] ?? false) ? 'bg-red-100' : 'bg-green-50' ?>">

            <?php if ($_SESSION['flash']['error'] ?? false): ?>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <p class="ml-3 text-sm font-bold text-red-600"><?php echo $_SESSION['flash']['msg']; ?></p>
                </div>
            <?php else: ?>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                              clip-rule="evenodd"/>
                    </svg>
                    <p class="ml-3 text-sm font-bold text-green-600"><?= $_SESSION['flash']['msg']; ?></p>
                </div>
            <?php endif ?>

            <span @click="nofifiction=false;" class="inline-flex items-center cursor-pointer">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </span>
        </div>
    </div>
<?php endif ?>
<?php unset($_SESSION['flash']); //verwijderen zodat het volgende keer niet nog eens wordt getoond ?>


</body>
</html>