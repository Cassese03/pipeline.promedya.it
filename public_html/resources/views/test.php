
<script>

    var newCF;


    function fetchCF(callback) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'api/cf', true);
        xhr.onreadystatechange = function() {
            console.log(xhr.status);
            if (xhr.readyState === 4 && xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                var clientiSelect = document.getElementById('clientiSelect');

                clientiSelect.innerHTML = '<option value=""> Seleziona un cliente </option>';

                data.forEach(function(cliente) {
                    var option = document.createElement('option');
                    option.value = cliente.Descrizione;
                    option.textContent = cliente.Descrizione;
                    clientiSelect.appendChild(option);
                });
                
                console.log(data);

                $('.select2').select2();
            }
        };
        xhr.send();
    }

 document.addEventListener('DOMContentLoaded', function() {
    fetchCF();
});

$('#modalNewCF').on('hidden.bs.modal', function () {
    var clientiSelect = document.getElementById('clientiSelect');
    var option = document.createElement('option');
    option.value = newCF.Descrizione;
    option.textContent = newCF.Descrizione;
    clientiSelect.appendChild(option);
    option.selected = true;
});
</script>

 