'use strict';

let books = [];

function addBookToHTML(index) {
    let row = document.createElement('div');
    let wrapper = document.createElement('div');
    let author = document.createElement('div');
    let book = document.createElement('div');

    row.className = 'row';
    wrapper.className = 'wrapper slide';

    author.textContent = books[index].full_name;
    author.className = 'col';
    wrapper.appendChild(author);

    book.textContent = books[index].book_name;
    book.className = 'col';
    wrapper.appendChild(book);

    row.appendChild(wrapper);
    document.getElementById('books').appendChild(row);

    setTimeout(function () {
        addBookToHTML(index + 1);
    }, 100);
}

function search() {
    let input = document.getElementById('author-name');

    if (!input.value) {
        return;
    }

    let xmlhttp = new XMLHttpRequest();
    let url = "/search.php";
    let params = JSON.stringify({
        author_name: input.value
    });
    xmlhttp.open("POST", url);
    xmlhttp.setRequestHeader("Content-type", "application/json");
    xmlhttp.send(params); // or null, if no parameters are passed

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            try {
                books = JSON.parse(xmlhttp.responseText);
                document.getElementById('books').innerHTML = '';
                document.querySelector('.books-container').className = 'books-container show';

                addBookToHTML(0);
            } catch (error) {
                throw Error;
            }
        }
    }
}

document.addEventListener('DOMContentLoaded', function () {
    let filterButton = document.getElementById('filter-button');

    filterButton.addEventListener('click', function (event) {
        event.preventDefault();

        search();
    }, false);
}, false);
