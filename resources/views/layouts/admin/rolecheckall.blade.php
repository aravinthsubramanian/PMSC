<script>

    const permissionCheckbox = document.getElementById('permissions');
    const permissionboxes = document.querySelectorAll('.permissions');

    permissionCheckbox.addEventListener('change', function () {
        permissionboxes.forEach(checkbox => {
            checkbox.checked = permissionCheckbox.checked;
        });
    });
    permissionboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            if (!checkbox.checked) {
                permissionCheckbox.checked = false;
            }
        });
    });



    const roleCheckbox = document.getElementById('roles');
    const roleboxes = document.querySelectorAll('.roles');

    roleCheckbox.addEventListener('change', function () {
        roleboxes.forEach(checkbox => {
            checkbox.checked = roleCheckbox.checked;
        });
    });
    roleboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            if (!checkbox.checked) {
                roleCheckbox.checked = false;
            }
        });
    });

    const userCheckbox = document.getElementById('users');
    const userboxes = document.querySelectorAll('.users');
    userCheckbox.addEventListener('change', function () {
        userboxes.forEach(checkbox => {
            checkbox.checked = userCheckbox.checked;
        });
    });
    userboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            if (!checkbox.checked) {
                userCheckbox.checked = false;
            }
        });
    });

    
    const adminCheckbox = document.getElementById('admins');
    const adminboxes = document.querySelectorAll('.admins');
    adminCheckbox.addEventListener('change', function () {
        adminboxes.forEach(checkbox => {
            checkbox.checked = adminCheckbox.checked;
        });
    });
    adminboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            if (!checkbox.checked) {
                adminCheckbox.checked = false;
            }
        });
    });


    const categoryCheckbox = document.getElementById('categories');
    const categoryboxes = document.querySelectorAll('.categories');
    categoryCheckbox.addEventListener('change', function () {
        categoryboxes.forEach(checkbox => {
            checkbox.checked = categoryCheckbox.checked;
        });
    });
    categoryboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            if (!checkbox.checked) {
                categoryCheckbox.checked = false;
            }
        });
    });


    const subcategoryCheckbox = document.getElementById('subcategories');
    const subcategoryboxes = document.querySelectorAll('.subcategories');
    subcategoryCheckbox.addEventListener('change', function () {
        subcategoryboxes.forEach(checkbox => {
            checkbox.checked = subcategoryCheckbox.checked;
        });
    });
    subcategoryboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            if (!checkbox.checked) {
                subcategoryCheckbox.checked = false;
            }
        });
    });


    const productCheckbox = document.getElementById('products');
    const productboxes = document.querySelectorAll('.products');
    productCheckbox.addEventListener('change', function () {
        productboxes.forEach(checkbox => {
            checkbox.checked = productCheckbox.checked;
        });
    });
    productboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            if (!checkbox.checked) {
                productCheckbox.checked = false;
            }
        });
    });
    
    
</script>