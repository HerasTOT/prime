import { ref } from "vue";

export const useSignature = () => {
    const signature = ref();

    const options = ref({
        penColor: "rgb(0,0,0)",
        backgroundColor: "rgb(255, 255, 255)",
        maxWidth: 2,
        minWidth: 2,
    });

    const undoCanvas = () => {
        return signature.value.undo();
    };

    const clearCanvas = () => {
        return signature.value.clearCanvas();
    };

    return {
        // properties
        // options
        signature,
        options,
        // methods
        undoCanvas,
        clearCanvas
    };
};