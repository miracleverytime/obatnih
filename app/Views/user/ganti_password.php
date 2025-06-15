<?= $this->extend('layout/templateUser'); ?>
<?= $this->section('content'); ?>

<style>
    .container {
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .profile-title {
        font-size: 24px;
        color: #333;
        margin-bottom: 30px;
        font-weight: normal;
        text-align: center;
    }

    .form-row {
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin-bottom: 30px;
    }

    .form-group {
        width: 100%;
    }

    .form-input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        outline: none;
        transition: border-color 0.3s;
    }

    .form-input:focus {
        border-color: #666;
    }

    .form-buttons {
        display: flex;
        justify-content: center;
    }

    .btn-save {
        background-color: #666;
        color: white;
        padding: 10px 25px;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-save:hover {
        background-color: #555;
    }

    @media (max-width: 768px) {
        .container {
            margin: 20px;
            padding: 15px;
        }
    }
</style>



<?= $this->endSection(); ?>
