<script>
    const btnDiv1 = document.getElementById('btnDiv1');
    const btnDiv2 = document.getElementById('btnDiv2');
    const divContainer1 = document.getElementById('divContainer1');
    const divContainer2 = document.getElementById('divContainer2');

    function showDiv1() {
        // Toggle containers
        divContainer1.classList.remove('hidden');
        divContainer2.classList.add('hidden');

        // Button styles
        btnDiv1.classList.remove('btn-gray');
        btnDiv1.classList.add('btn-submit');

        btnDiv2.classList.remove('btn-submit');
        btnDiv2.classList.add('btn-gray');
    }

    function showDiv2() {
        // Toggle containers
        divContainer2.classList.remove('hidden');
        divContainer1.classList.add('hidden');

        // Button styles
        btnDiv2.classList.remove('btn-gray');
        btnDiv2.classList.add('btn-submit');

        btnDiv1.classList.remove('btn-submit');
        btnDiv1.classList.add('btn-gray');
    }
    showDiv1();
</script>
