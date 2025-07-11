document.addEventListener("DOMContentLoaded", () => {
    loadTickets();
});

function loadTickets() {
    fetch(fetchRoute)
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById("ticketBody");
            tbody.innerHTML = "";

            data.forEach(ticket => {
                const showActions = isAllTicketsPage === "true";

                const buttons = showActions ? `
                    <td>
                        <button onclick="updateTicket(this)">💾</button>
                        <button onclick="deleteTicket(${ticket.id})">🗑️</button>
                    </td>` : "";

                tbody.innerHTML += `
                       <tr data-id="${ticket.id}">
                        <td>#${ticket.id}</td>
                        <td contenteditable="${showActions}">${ticket.name}</td>
                        <td contenteditable="${showActions}">${ticket.subject}</td>
                        <td contenteditable="${showActions}">${ticket.status}</td>
                        <td contenteditable="${showActions}">${ticket.raised_by}</td>
                        <td contenteditable="${showActions}">${ticket.priority}</td>
                        ${buttons}
                    </tr>
                

                `;
            });
        });
}


