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

                       
                        <!-- Media column -->
                       <td>
                            ${ticket.media_path
                                ? `<a href="${ticket.media_path}" target="_blank">${ticket.media_path.includes('.mp4') ? '🎥 Video' : '🖼️ Image'}</a>`
                                : 'No Media'}
                       </td>



                        <!-- Location column -->
                        <td>
                            ${ticket.location_url ? `<a href="${ticket.location_url}" target="_blank">📍 View</a>` : 'No Location'}
                        </td>

                        ${buttons}
                     </tr>

                `;
            });
        });
}


function updateTicket(button) {
    let row = button.closest("tr");
    let id = row.dataset.id;

    let data = {
        id: id,
        name: row.cells[1].innerText,
        subject: row.cells[2].innerText,
        status: row.cells[3].innerText,
        raised_by: row.cells[4].innerText,
        priority: row.cells[5].innerText
    };

    fetch(updateRoute, {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(() => loadTickets());
}

function deleteTicket(id) {
    fetch(deleteRoute, {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ id: id })
    })
    .then(res => res.json())
    .then(() => loadTickets());
}
function downloadCSV() {
    const table = document.querySelector("table");
    const rows = Array.from(table.querySelectorAll("tr"));
    const includeMedia = isAllTicketsPage === "true";

    const csvContent = rows.map((row, rowIndex) => {
        const cols = Array.from(row.querySelectorAll("th, td"));
        const cells = cols.map((col, colIndex) => {
            // If it's a <th>, return text as-is
            if (col.tagName.toLowerCase() === "th") {
                return `"${col.textContent.trim()}"`;
            }

            // Media column (index 6) and Location column (index 7)
            if (includeMedia && rowIndex !== 0) {
                if (colIndex === 6 || colIndex === 7) {
                    const link = col.querySelector("a");
                    return `"${link ? link.href : 'No Link'}"`;
                }
            }

            return `"${col.textContent.trim()}"`;
        });

        // If not All Tickets page, keep only first 6 columns
        if (!includeMedia) {
            return cells.slice(0, 6).join(",");
        }

        return cells.join(",");
    }).join("\n");

    const blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
    const url = URL.createObjectURL(blob);

    const a = document.createElement("a");
    a.href = url;
    a.download = "tickets.csv";
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
}
