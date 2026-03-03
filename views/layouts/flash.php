<?php
$flashError = getFlash('error');
$flashSuccess = getFlash('success');
?>

<?php if ($flashError): ?>
<div id="flash-error" class="flex items-center gap-3 p-4 mb-4 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 text-sm animate-fade-in">
    <i class="fas fa-exclamation-circle"></i>
    <span><?= e($flashError) ?></span>
    <button onclick="this.parentElement.remove()" class="ml-auto text-red-500 hover:text-red-700">
        <i class="fas fa-times"></i>
    </button>
</div>
<?php endif; ?>

<?php if ($flashSuccess): ?>
<div id="flash-success" class="flex items-center gap-3 p-4 mb-4 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 text-sm animate-fade-in">
    <i class="fas fa-check-circle"></i>
    <span><?= e($flashSuccess) ?></span>
    <button onclick="this.parentElement.remove()" class="ml-auto text-green-500 hover:text-green-700">
        <i class="fas fa-times"></i>
    </button>
</div>
<?php endif; ?>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in { animation: fadeIn 0.3s ease-out; }
</style>

<script>
// Auto-dismiss flash messages after 5 seconds
setTimeout(() => {
    document.querySelectorAll('[id^="flash-"]').forEach(el => {
        el.style.transition = 'opacity 0.3s';
        el.style.opacity = '0';
        setTimeout(() => el.remove(), 300);
    });
}, 5000);
</script>
