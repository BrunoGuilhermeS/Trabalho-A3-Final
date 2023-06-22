$(document).ready(function () {

  /*===Funcionamento do botão toggle, esconde sidebar===*/
  const toggle = document.querySelector(".toggle");
  const sidebar = document.querySelector(".sidebar");
  const content_area = document.querySelector(".content-area")

  toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    content_area.classList.toggle("close");
  });
  //===
  //===Limpa as caixas de texto do Chamado===//
  $("#cancelarCriarOp").click(function () {
    // Limpa o valor de todos os campos de entrada
    $(".form-op input[type='text']").val("");
  });
  //===
  //===Histórico de Chamados===//

  function fecharDetalhes() {
    const detalhes = document.querySelector(".detalhes");
    const detailsOp = document.querySelector(".details-op");

    // Oculta os detalhes e exibe a primeira parte
    detalhes.style.display = "none";
    detailsOp.style.display = "none";
}
});

 // Função para abrir os detalhes do chamado
 function abrirDetalhesPostit() {
  // Obter os elementos HTML dos campos de detalhes
  const idPrimariaInput = document.getElementById("idPrimaria");
  const suporteInput = document.getElementById("suporte");
  const clienteInput = document.getElementById("cliente");
  const motivoInput = document.getElementById("motivo");
  const dataInput = document.getElementById("data");
  const descricaoInput = document.getElementById("descricao");


  // Obter o chamado selecionado na tabela
  const chamadoSelecionado = this;

  // Preencher os campos de detalhes com as informações do chamado selecionado
  idPrimariaInput.value = chamadoSelecionado.querySelector("td:nth-child(1)").textContent;
  suporteInput.value = chamadoSelecionado.querySelector("td:nth-child(2)").textContent;
  clienteInput.value = chamadoSelecionado.querySelector("td:nth-child(4)").textContent;
  motivoInput.value = chamadoSelecionado.querySelector("td:nth-child(5)").textContent;
  dataInput.value = chamadoSelecionado.querySelector("td:nth-child(6)").textContent;
  descricaoInput.value = chamadoSelecionado.querySelector(".hidden").textContent;

  // Exibir os detalhes do chamado
  const detalhes = document.querySelector(".detalhes");
  const detailsOp = document.querySelector(".details-op");
  detalhes.style.display = "block";
  detailsOp.style.display = "block";
}

// Obter todas as linhas da tabela com a classe "linha-atendimento"
const linhasAtendimento = document.querySelectorAll(".linha-atendimento");

// Adicionar evento de clique a cada linha de atendimento
linhasAtendimento.forEach((linha) => {
  linha.addEventListener("click", abrirDetalhesPostit);
});

// Função para fechar os detalhes do chamado
function fecharDetalhes() {
  const detalhes = document.querySelector(".detalhes");
  const detailsOp = document.querySelector(".details-op");

  // Oculta os detalhes e exibe a primeira parte
  detalhes.style.display = "none";
  detailsOp.style.display = "none";
}

