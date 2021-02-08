<h1>
    Hello <?= $name; ?>
</h1>

<form method="post" action="." class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 max-w-md">
    <br>
    <h1 class="block text-gray-700 font-bold mb-2 text-xl text-center">Ajouter un nom à afficher</h1>
    <br>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
            Nom
        </label>
        <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                name="name" id="name" type="text" placeholder="Nom à afficher" required>
    </div>
    <div class="mb-4">
        <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-white bg-green-600 leading-tight focus:outline-none focus:shadow-outline cursor-pointer"
                id="name" type="submit" value="Envoyer">
    </div>

</form>
