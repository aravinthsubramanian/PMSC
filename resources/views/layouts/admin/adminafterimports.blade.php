<script>
    var i = 0;
    $("#dynamic-ar").click(function() {
        ++i;
        $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + i +
            '][specification]" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
        );
    });
    $(document).on('click', '.remove-input-field', function() {
        $(this).parents('tr').remove();
    });
</script>

<script>
    $(document).ready(function() {
        
        const categorySelect = document.getElementById('categorySelect');
        const subcategorySelect = document.getElementById('subcategorySelect');

        categorySelect.addEventListener('change', function() {
            const categoryId = categorySelect.value;
            // Clear previous options in subcategory select
            subcategorySelect.innerHTML = '<option value="" selected></option>';
            // Fetch subcategories for the selected category
            fetch(`/PMSC/public/api/categories/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(subcategory => {
                        const option = document.createElement('option');
                        option.value = subcategory.id;
                        option.textContent = subcategory.subcategory;
                        subcategorySelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching subcategories:', error));
        });

        // subcategorySelect.addEventListener('click', function() {
        //     const categoryId = categorySelect.value;
        //     // Clear previous options in subcategory select
        //     subcategorySelect.innerHTML = '<option value="" selected></option>';
        //     // Fetch subcategories for the selected category
        //     fetch(`/Acart/public/api/categories/${categoryId}`)
        //         .then(response => response.json())
        //         .then(data => {
        //             data.forEach(subcategory => {
        //                 const option = document.createElement('option');
        //                 option.value = subcategory.id;
        //                 option.textContent = subcategory.subcategory;
        //                 subcategorySelect.appendChild(option);
        //             });
        //         })
        //         .catch(error => console.error('Error fetching subcategories:', error));
        // });

        var fileArr = [];
        var src = [];
        $("#images").change(function() {
            // check if fileArr length is greater than 0
            if (fileArr.length > 0) fileArr = [];
            // $('#image_preview').html("");
            var total_file = document.getElementById("images").files;
            if (!total_file.length) return;
            for (var i = 0; i < total_file.length; i++) {
                fileArr.push(total_file[i]);
                $('#image_preview').append(
                    "<div class='img-div' id='img-div" + i + "'>" +
                    "<img src='" + URL.createObjectURL(event.target.files[i]) +
                    "' class='img-responsive image img-thumbnail' title='" + total_file[i]
                    .name + "'>" +
                    "<div class='middle'>" +
                    "<button id='action-icon' value='img-div" + i +
                    "' class='btn btn-danger' role='" + total_file[i].name + "'>" +
                    "<i class='fa fa-trash'></i>" +
                    "</button>" +
                    "</div>" +
                    "</div>"
                );
            }
        });

        $('body').on('click', '#action-icon', function(evt) {
            var divName = this.value;
            var fileName = $(this).attr('role');
            $(`#${divName}`).remove();
            for (var i = 0; i < fileArr.length; i++) {
                if (fileArr[i].name === fileName) {
                    fileArr.splice(i, 1);
                }
            }
            document.getElementById('images').files = FileListItem(fileArr);
            evt.preventDefault();
        });

        function FileListItem(file) {
            file = [].slice.call(Array.isArray(file) ? file : arguments)
            for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
            if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
            for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
            return b.files
        }

    });
</script>

<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });
</script>

<style>
    .img-div {
        position: relative;
        width: 20%;
        /* float: left; */
        display: inline-block;
        margin: 1rem 0;
        justify-content: space-around;
        margin-right: 5px;
        margin-left: 5px;
        margin-bottom: 5px;
        margin-top: 5px;
    }

    .image {
        opacity: 1;
        display: block;
        width: 70%;
        max-width: auto;
        transition: .5s ease;
        backface-visibility: hidden;
    }

    .middle {
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        top: 50%;
        left: 35%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
    }

    .img-div:hover .image {
        opacity: 0.3;
    }

    .img-div:hover .middle {
        opacity: 1;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
