let i = 0;
let content = "許多創意專題等著你!!";
setInterval(function () {
    document.querySelector('#type').textContent += content.charAt(i);
    i++
    if (i === content.length) {

        setTimeout(() => {
            document.querySelector('#type').textContent = '';
            i = 0;
        }, 2000)
    }
}, 200);
