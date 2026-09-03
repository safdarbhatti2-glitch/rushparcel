<?php if (!empty($flash_success)): ?>
    <div class="alert alert-success">
        <span>✅</span>
        <div><?= e($flash_success) ?></div>
    </div>
<?php endif; ?>

<?php if (!empty($flash_error)): ?>
    <div class="alert alert-error">
        <span>⚠️</span>
        <div><?= e($flash_error) ?></div>
    </div>
<?php endif; ?>
