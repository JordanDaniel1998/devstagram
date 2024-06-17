import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube aquí tu imagen",
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false,
    init: function () {
        if (document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name =
                document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(
                this,
                imagenPublicada,
                `/uploads/${imagenPublicada.name}`
            );

            imagenPublicada.previewElement.classList.add(
                "dz-success",
                "dz-complete"
            );
        }

        this.on("maxfilesexceeded", function (file) {
            this.removeFile(file); // Remover el archivo si se excede el límite
        });
        this.on("success", function (file, response) {
            // Manejo de la respuesta exitosa del servidor
            document.querySelector('[name="imagen"]').value = response.imagen;
        });
        this.on("error", function (file, response) {
            // Manejo de errores
            console.log(response);
        });
        this.on("removedfile", function () {
            document.querySelector('[name="imagen"]').value = "";
        });
    },
});
