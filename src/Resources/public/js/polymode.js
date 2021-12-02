const unityCanvas = document.querySelector("#unity-canvas");

createUnityInstance(unityCanvas, {
    dataUrl: unityCanvas.getAttribute('data-path') + ".data.unityweb",
    frameworkUrl: unityCanvas.getAttribute('data-path') + ".framework.js.unityweb",
    codeUrl: unityCanvas.getAttribute('data-path') + ".wasm.unityweb",
    streamingAssetsUrl: "StreamingAssets",
    companyName: "Duncrow GmbH",
    productName: "Polymode",
    productVersion: "1.3",
}).then(function (instance) {
    const canvas = instance.Module.canvas;
    const container = canvas.parentElement;
    container.style.width = "100%";
    container.style.height = "650px";
});

function OpenPano(args) {
    $.featherlight('<iframe src="'+args+'"></iframe>', {
        root: unityCanvas.parentElement
    });
}
