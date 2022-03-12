function myFunction2() {
    var input2, filter2, table2, tr2, td2, a, txtValue2;
    input2 = document.getElementById("search2");
    filter2 = input2.value.toUpperCase();
    table2 = document.getElementById("table2");
    tr2 = table2.getElementsByTagName("tr");
    for (a = 0; a < tr2.length; a++) {
      td2 = tr2[a].getElementsByTagName("td")[0];
      if (td2) {
        txtValue2 = td2.textContent || td2.innerText;
        if (txtValue2.toUpperCase().indexOf(filter2) > -1) {
          tr2[a].style.display = "";
        } else {
          tr2[a].style.display = "none";
        }
      }       
    }
  }