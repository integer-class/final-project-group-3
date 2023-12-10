<style>
     /* Style untuk modal */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
}

.modal-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Tombol penutup modal */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

</style>
<!-- Tombol untuk membuka modal dengan ID 1 -->
<button onclick="bukaModal(2)">Buka Modal 1</button>

<!-- Modal dengan ID 1 -->
<div id="modal1" class="modal">
    <!-- Konten Modal 1 -->
    <span class="close" onclick="tutupModal(1)">&times;</span>
    <p>Isi dari Modal 1 di sini.</p>
</div>

<!-- Script JavaScript -->
<script>
    // Fungsi untuk membuka modal berdasarkan ID
function bukaModal(modalId) {
    var modal = document.getElementById('modal' + modalId);
    modal.style.display = "block";
}

// Fungsi untuk menutup modal berdasarkan ID
function tutupModal(modalId) {
    var modal = document.getElementById('modal' + modalId);
    modal.style.display = "none";
}

// Menutup modal jika pengguna mengklik di luar area modal
window.onclick = function (event) {
    var modals = document.getElementsByClassName('modal');
    for (var i = 0; i < modals.length; i++) {
        var modal = modals[i];
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }
}

</script>

