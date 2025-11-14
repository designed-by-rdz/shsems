if (document.getElementById('notification')) {
    setTimeout(() => {
        document.getElementById('notification').style.display = 'none';
    }, 5000);
}

function goTo(site) {
    window.location.href=site;
}

function searchTable() {
    row = ".row-selection";
    needle = ".row-unique";
    let cards = document.querySelectorAll(row);
    let names = document.querySelectorAll(needle);
    let search_query = document.getElementById("searchbox").value;
    for (var i = 0; i < cards.length; i++) {
        if(names[i].innerText.toLowerCase()
            .includes(search_query.toLowerCase())) {
            cards[i].classList.remove("is-hidden");
        } else {
            cards[i].classList.add("is-hidden");
        }
    }
}

function decodeCustomURL(url) {
    url = url.replaceAll("+"," ");
    url = decodeURIComponent(url);
    return url
}

function shuffleArray(array) {
  let currentIndex = array.length, randomIndex;
  while (currentIndex > 0) {
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex--;
    [array[currentIndex], array[randomIndex]] = [
      array[randomIndex], array[currentIndex]
    ];
  }
  return array;
}