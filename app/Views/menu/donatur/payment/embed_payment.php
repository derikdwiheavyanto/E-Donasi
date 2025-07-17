<?= $this->extend('layout/layout'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid px-0 py-2">
    <div class="row gx-0">
        <div class="col-12">
            <!-- Snap akan ditanam di sini -->
            <div id="snap-container" style="min-height: 100vh;"></div>

            <!-- Form tersembunyi untuk submit status transaksi -->
            <form id="submit-form" method="post" action="/donatur/donasi/simpan">
                <?= csrf_field() ?>
                <input type="hidden" name="nominal" value="<?= esc($nominal) ?>">
                <input type="hidden" name="pembayaran" value="<?= esc($pembayaran) ?>">
                <input type="hidden" name="snap_token" value="<?= esc($snap_token) ?>">
                <input type="hidden" name="transaction_status" id="transaction_status" value="">
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<!-- Midtrans Snap.js -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="<?= env('MIDTRANS_CLIENT_KEY') ?>"></script>

<!-- CSS agar iframe Snap menjadi full layout -->
<style>
    #snap-container iframe {
        width: 100% !important;
        min-height: 100vh !important;
        border: none;
    }
</style>

<!-- Embed Snap -->
<script>
    window.snap.embed("<?= $snap_token ?>", {
        embedId: "snap-container",
        onSuccess: function (result) {
            document.getElementById('transaction_status').value = result.transaction_status;
            document.getElementById('submit-form').submit();
        },
        onPending: function (result) {
            document.getElementById('transaction_status').value = result.transaction_status;
            document.getElementById('submit-form').submit();
        },
        onError: function (result) {
            alert("Transaksi gagal.");
            console.log(result);
        },
        onClose: function () {
            alert("Anda menutup pembayaran sebelum selesai.");
        }
    });
</script>
<?= $this->endSection(); ?>