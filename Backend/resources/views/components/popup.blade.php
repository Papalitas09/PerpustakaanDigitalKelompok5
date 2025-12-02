<!-- Button untuk membuka modal -->
<button onclick="openModal()" 
    class="px-4 py-2 bg-blue-600 text-white rounded-lg">
    Lihat Detail Peminjaman
</button>

<!-- Overlay + Modal -->
<div id="modalDetail" class="fixed inset-0 z-50 hidden">

    <!-- Background blur -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"
         onclick="closeModal()"></div>

    <!-- Card Modal -->
    <div class="relative mx-auto mt-10 max-w-4xl bg-white rounded-2xl shadow-xl p-6 md:p-10">

        <!-- Back Button -->
        <button onclick="closeModal()" 
                class="flex items-center gap-1 text-gray-700 hover:text-black mb-4">
            ← Back
        </button>

        <h2 class="text-center text-2xl font-bold mb-6">DETAIL PEMINJAMAN</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- LEFT : Cover -->
            <div class="flex flex-col items-center md:col-span-1">
                <img src="" 
                    alt="Cover" 
                    class="w-48 md:w-56 rounded-lg shadow">

                <p class="font-semibold mt-4 text-center">
                    Made in Abyss - volume 1
                </p>

                <p class="text-sm text-gray-500 underline">
                    Tsukushi Akito
                </p>

                <button class="mt-4 w-full bg-black text-white py-2 rounded-xl font-semibold">
                    KONFIRMASI
                </button>
            </div>

            <!-- RIGHT : Info Buku -->
            <div class="md:col-span-2 space-y-3">

                <p><strong>Status:</strong> TERSEDIA</p>

                <p><strong>Judul:</strong><br>
                    Made in Abyss - volume 1
                </p>

                <p><strong>Pengarang:</strong><br>
                    Tsukushi Akito
                </p>

                <p><strong>Tanggal Terbit:</strong><br>
                    31 Juli 2013
                </p>

                <p class="text-justify">
                    <strong>Sinopsis:</strong><br>
                    memperkenalkan Riko, seorang yatim piatu yang tinggal di kota Orth 
                    dan bermimpi menjadi seorang Cave Raider seperti ibunya, Lyza. 
                    Di volume pertama ini, Riko bertemu dengan Reg, sebuah robot...
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                    <div>
                        <label class="font-semibold">Tanggal Pengambilan</label>
                        <input type="date" class="w-full mt-1 p-2 border rounded-lg">
                    </div>

                    <div>
                        <label class="font-semibold">Tanggal Dikembalikan</label>
                        <input type="date" class="w-full mt-1 p-2 border rounded-lg">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function openModal() {
        document.getElementById("modalDetail").classList.remove("hidden");
    }

    function closeModal() {
        document.getElementById("modalDetail").classList.add("hidden");
    }
</script>
