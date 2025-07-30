document.addEventListener("DOMContentLoaded", () => {
    loadTickets();
});

function loadTickets() {
    fetch(fetchRoute)
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById("ticketBody");
            tbody.innerHTML = "";

            // Initialize counts
            let total = 0;
            let open = 0;
            let closed = 0;
            let highPriority = 0;

            data.forEach(ticket => {
                total++;

                const status = ticket.status.toLowerCase();
                const priority = ticket.priority.toLowerCase();

                if (
                    status === "opend" ||
                    status === "visiting site" ||
                    status === "in progress"
                    ) 
                    {  open++;
                    }

                if (status === "closed") closed++;
                if (priority === "high") highPriority++;

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

            // Update summary cards
            document.getElementById("totalCount").textContent = total;
            document.getElementById("openCount").textContent = open;
            document.getElementById("closedCount").textContent = closed;
            document.getElementById("priorityCount").textContent = highPriority;
        })
        .catch(err => {
            console.error("Error loading tickets:", err);
        });
}
