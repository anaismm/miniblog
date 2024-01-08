const lessButton = document.querySelector('.see-less');
const allBillets = document.querySelector('.all-comments');

function showOrHideComments(){
    lessButton.classList.toggle('active');
    allBillets.classList.toggle('hidden');
}

lessButton.addEventListener('click',showOrHideComments);

