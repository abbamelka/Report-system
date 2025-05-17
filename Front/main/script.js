let currentPage = 1;
const resultsPerPage = 5; // Change this to your desired number of results per page

document.getElementById('serchBtn').addEventListener('click', function() {
    const type = encodeURIComponent(document.getElementById('type').value);
    const area = encodeURIComponent(document.getElementById('area').value);
    const date = encodeURIComponent(document.getElementById('date').value);
    const uname = encodeURIComponent(document.getElementById('uname').value);

    const url = `../../Back/fetcheg.php?type=${type}&area=${area}&date=${date}&uname=${uname}&page=${currentPage}&resultsPerPage=${resultsPerPage}`;
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Fetched data:', data); // Log the response
            if (Array.isArray(data.results)) {
                displayResults(data.results);
                setupPagination(data.totalResults);
            } else {
                console.error('Data is not an array:', data);
            }
			
        })
        .catch(error => console.error('Error:', error));
});

function displayResults(results) {
    const tbody = document.querySelector('#resultsTable tbody');
    tbody.innerHTML = ''; // Clear previous results

    results.forEach(row => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${row.Reporttype}</td>
            <td>${row.area}</td>
            <td>${row.Reportsubject}</td>
            <td>${row.detail}</td>
            <td>${row.uname}</td>
            <td>${row.Creationdate}</td>
        `;
        tbody.appendChild(tr);
    });
}

function setupPagination(totalResults) {
    const totalPages = Math.ceil(totalResults / resultsPerPage);
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = ''; // Clear previous pagination

    for (let i = 1; i <= totalPages; i++) {
        const li = document.createElement('li');
        li.className = 'page-item';

        const a = document.createElement('a');
        a.className = 'page-link';
        a.href = '#';
        a.innerText = i;
        a.addEventListener('click', function() {
            currentPage = i;
            fetchResults(); // Fetch results for the selected page
        });

        li.appendChild(a);
        pagination.appendChild(li);
    }
    updateActivePage(); // Call this function to highlight the current page
}
function updateActivePage() {
    const pageLinks = document.querySelectorAll('#pagination .page-item');
    pageLinks.forEach((link, index) => {
        link.classList.remove('active'); // Remove active class from all links
        if (index + 1 === currentPage) {
            link.classList.add('active'); // Add active class to the current page link
        }
    });
}
function fetchResults() {
    // Call the search function again to get results for the current page
    document.getElementById('serchBtn').click();
}

// Event listener for exporting to PDF
document.getElementById('exportBtn').addEventListener('click', function() {
    const type = encodeURIComponent(document.getElementById('type').value);
    const area = encodeURIComponent(document.getElementById('area').value);
    const reportSubject = encodeURIComponent(document.getElementById('Reportsubject').value);
    const date = encodeURIComponent(document.getElementById('date').value);
    const uname = encodeURIComponent(document.getElementById('uname').value);

    const queryString = `?type=${type}&area=${area}&subject=${reportSubject}&date=${date}&uname=${uname}`;
    window.location.href = `../../Back/export.php${queryString}`;
});