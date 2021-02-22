
document.addEventListener('DOMContentLoaded', () => {

    // Have each button change the color of the heading
    document.querySelectorAll('.sub-menu').forEach( a => {
        a.onclick = () => {
            document.querySelector('#hello').innerHTML.style.content = a.dataset.content;
        };
    });

});
