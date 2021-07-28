function consultaCep(){
    var cep = document.getElementById("cep").value;
    var cep = cep.replace('.', '');
    var cep = cep.replace('-', '');
    var cep = cep.replace(' ', '');
    var sizeCep = cep.length;
    
    if(cep !== null && sizeCep == 8)
    {
        var url = "http://viacep.com.br/ws/"+cep+"/json/";

        $.ajax({
            url: url,
            type: "GET",
            success: function(response){
                    if(response.cep == null)
                    {
                        alert("CEP inválido, favor digitar um CEP válido!");
                    } else{
                        console.log(response);
                        $("#address").val(response.logradouro);
                        $("#district").val(response.bairro);
                        $("#city").val(response.localidade);
                        $("#uf").val(response.uf);
                    }
            }
        })
    } else{
        alert("Digite um CEP valido!")
    }
}