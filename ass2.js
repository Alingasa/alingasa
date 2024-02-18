const submitButton = document.getElementById('signin');
const tableBody = document.getElementById('tableBody');

submitButton.addEventListener('click', () => {
  var Title = document.getElementById("title").value;
  var bookAuthor = document.getElementById("book_author").value;
  var Pages = document.getElementById("pages").value;
  var Price = document.getElementById("price").value;

  const data = {
    title: Title,
    book_author: bookAuthor,
    pages: Pages,
    price: Price,
  };

  fetch("http://localhost/Activity/assignment2/ass2.php", {
    method: "POST",
    headers: {
      "Content-type": "application/json",
    },
    body: JSON.stringify(data),
  })
  .then((res) => res.json())
  .then((response) => {
    console.log(response);
   
    const newRow = `<tr>
                      <td>${response.id}</td>
                      <td>${response.title}</td>
                      <td>${response.book_author}</td>
                      <td>${response.price}</td>
                      <td>${response.pages}</td>
                    </tr>`;
    tableBody.insertAdjacentHTML('afterbegin', newRow);
  });
});
