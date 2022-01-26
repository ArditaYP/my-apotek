const inputs = document.querySelectorAll(".input");


function addcl(){
	let parent = this.parentNode.parentNode;
	parent.classList.add("focus");
}

function remcl(){
	let parent = this.parentNode.parentNode;
	if(this.value == ""){
		parent.classList.remove("focus");
	}
}


inputs.forEach(input => {
	input.addEventListener("focus", addcl);
	input.addEventListener("blur", remcl);
});

const daftarLink = document.querySelector('#daftarLink'); // daftar link
const masukBtn = document.querySelector('#masukBtn'); // masuk button
daftarLink.addEventListener('click', (e) => {
    e.preventDefault();

    masukBtn.innerHTML = 'Daftar';
    masukBtn.setAttribute('name', 'daftarBtn');
    masukBtn.setAttribute('id', 'dafarBtn');
    masukBtn.setAttribute('value', 'Daftar');

	console.log('ok');
});

