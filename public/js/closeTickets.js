document.addEventListener("DOMContentLoaded", function () {
    fetchClosedTickets();
});

function fetchClosedTickets() {
    fetch(fetchRoute)
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById("closedTicketBody");
            const count = document.getElementById("closed-count");
            tbody.innerHTML = "";
            let closedCount = 0;

            data.forEach(ticket => {
                if (ticket.status === "closed") {
                    closedCount++;
                    const row = `
                        <tr>
                            <td>${ticket.id}</td>
                            <td>${ticket.name}</td>
                            <td>${ticket.subject}</td>
                            <td>${ticket.status}</td>
                            <td>${ticket.priority}</td>
                            <td>${new Date(ticket.updated_at).toLocaleString()}</td>
                            <td>
                            ${ticket.location_url
                                ? `<a href="${ticket.location_url}" target="_blank">📍 View</a>`
                                : 'No Location'}
                            </td>
                        </tr>
                    `;
                    tbody.innerHTML += row;
                }
            });

            count.textContent = closedCount;
        })
        .catch(error => console.error("Fetch Error:", error));
}
