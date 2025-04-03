export const dataUriToFile = (dataUri, fileName) => {
    // Separar el encabezado del contenido Base64
    const [header, base64] = dataUri.split(",");

    // Obtener el tipo MIME del encabezado
    const mime = header.match(/:(.*?);/)[1]; // Ejemplo: "image/jpeg"

    // Decodificar Base64 a datos binarios
    const binary = atob(base64);
    const array = new Uint8Array(binary.length);

    for (let i = 0; i < binary.length; i++) {
        array[i] = binary.charCodeAt(i);
    }

    // Crear un archivo Blob
    return new File([array], fileName, { type: mime });
};