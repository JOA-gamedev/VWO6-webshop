<div x-data="{ modelConfirm: false }" class="<?= $class ?? '' ?>">
    <button @click="modelConfirm =!modelConfirm" class="flex justify-center text-white text-md bg-red-500 hover:bg-red-600 border border-gray-200 focus:ring-4 focus:outline-none shadow-md focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center ">
        <span> Verwijder </span>
    </button>

    <div x-show="modelConfirm" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
            <div x-cloak @click="modelConfirm = true" x-show="modelConfirm"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 transition-opacity bg-gray-700 bg-opacity-60" aria-hidden="true"
            ></div>

            <div x-cloak x-show="modelConfirm"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block w-full max-w-md p-6 my-10 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl xl:max-w-xl"
            >
                <div class="flex items-center justify-between space-x-4">
                    <h1 class="text-xl font-bold text-gray-800 "><?= $titel ?? 'Verwijderen' ?></h1>
                </div>

                <p class="mt-2 text-md text-gray-800 ">
                    <?= $content ?? 'Wanneer je verder gaat, wordt dit item permanent verwijderd. Weet je het zeker?' ?>
                </p>

                <x-text-input name="id" type="hidden" value="{{ $site->id }}"/>

                <div class="flex justify-end mt-6">
                    <button for="show"
                            @click="modelConfirm = false" type="button" class="mr-2 px-2 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-gray-500 hover:bg-gray-600 rounded-md shadow-md">
                        Annuleren
                    </button>
                    <form action="<?= $action ?? '' ?>" method="post">
                        <?= csrf(); ?>
                        <?= method_delete(); ?>
                        <button for="show"
                                type="submit"
                                @click="modelConfirm = false" class="mr-2 px-2 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-500 hover:bg-red-600 rounded-md shadow-md">
                            Verwijderen
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>