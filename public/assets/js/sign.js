let wrapper = document.getElementById("signature-pad");
let clearButton = document.querySelector("[data-action=clear]");
let savePNGButton = document.querySelector("[data-action=save]");
let canvas = document.querySelector("canvas");
canvas.width = canvas.width * 1;
let signaturePad;
signaturePad = new SignaturePad(canvas);
clearButton.addEventListener("click", function () {
	signaturePad.clear();
});
savePNGButton.addEventListener("click", function (event) {
	if (signaturePad.isEmpty()) {
		alert("Please provide signature first.");
		event.preventDefault();
	} else {
		let canvas = document.getElementById("signature-canvas");
		var anchor = document.createElement("a");
		anchor.href = canvas.toDataURL("image/png");
		anchor.download = "ttd.png";
		anchor.click();
	}
});