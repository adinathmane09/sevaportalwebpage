document.addEventListener("DOMContentLoaded", () => {
    loadTickets();
});

function loadTickets() {
    fetch(fetchRoute)
        .then(res => res.json())
        .then(data => {
            originalTicketData = data; 
            renderTickets(data); 
            const tbody = document.getElementById("ticketBody");
            tbody.innerHTML = "";//clears all tbody data lol

            data.forEach(ticket => {
                const showActions = isAllTicketsPage === "true";

                const buttons = showActions ? `
                    <td>
                        <button onclick="enableEdit(this)">✏️</button>
                        <button onclick="updateTicket(this)">💾</button>
                        <button onclick="deleteTicket(${ticket.id})">🗑️</button>
                    </td>` : "";//om omkar awale 

                tbody.innerHTML += `
                     <tr data-id="${ticket.id}">
                        <td>#${ticket.id}</td>
                        <td>${ticket.name}</td>
                        <td>${ticket.subject}</td>
                        <td>${ticket.status}</td>
                        <td>${ticket.raised_by}</td>
                        <td>${ticket.priority}</td>

                       
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

let originalTicketData = []; // Store all ticket data

function searchById() {
    const searchValue = document.getElementById("searchId").value.trim();
    const tbody = document.getElementById("ticketBody");

    // Restore original if search is empty
    if (searchValue === "") {
        renderTickets(originalTicketData);
        return;
    }

    // Find the ticket by ID
    const matched = originalTicketData.find(t => t.id.toString() === searchValue);

    if (matched) {
        const others = originalTicketData.filter(t => t.id.toString() !== searchValue);
        renderTickets([matched, ...others]);

        // Wait for DOM update then highlight
        setTimeout(() => {
            const firstRow = document.querySelector("#ticketBody tr");
            if (firstRow) {
                firstRow.classList.add("highlight-row");

                // Optional: Remove highlight after a few seconds
                setTimeout(() => {
                    firstRow.classList.remove("highlight-row");
                }, 3000);
            }
        }, 100);
    }
}

function renderTickets(tickets) {
    const tbody = document.getElementById("ticketBody");
    tbody.innerHTML = "";

    tickets.forEach(ticket => {
        const showActions = isAllTicketsPage === "true";

        const buttons = showActions ? `
            <td>
                <button onclick="enableEdit(this)">✏️</button>
                <button onclick="updateTicket(this)">💾</button>
                <button onclick="deleteTicket(${ticket.id})">🗑️</button>
            </td>` : "";

        tbody.innerHTML += `
            <tr data-id="${ticket.id}">
                <td>#${ticket.id}</td>
                <td>${ticket.name}</td>
                <td>${ticket.subject}</td>
                <td>${ticket.status}</td>
                <td>${ticket.raised_by}</td>
                <td>${ticket.priority}</td>

                <td>
                    ${ticket.media_path
                        ? `<a href="${ticket.media_path}" target="_blank">${ticket.media_path.includes('.mp4') ? '🎥 Video' : '🖼️ Image'}</a>`
                        : 'No Media'}
                </td>

                <td>
                    ${ticket.location_url ? `<a href="${ticket.location_url}" target="_blank">📍 View</a>` : 'No Location'}
                </td>

                ${buttons}
            </tr>
        `;
    });
}

function enableEdit(button) {
    // Disable all rows first
    document.querySelectorAll("#ticketBody tr").forEach(row => {
        for (let i = 1; i <= 5; i++) {
            row.cells[i].setAttribute("contenteditable", "false");
        }
        // Hide save buttons
        const saveBtn = row.querySelector("button[onclick^='updateTicket']");
        if (saveBtn) saveBtn.style.display = "none";
    });

    // Enable current row
    const row = button.closest("tr");
    for (let i = 1; i <= 5; i++) {
        row.cells[i].setAttribute("contenteditable", "true");
    }

    // Show save button for this row
    const saveBtn = row.querySelector("button[onclick^='updateTicket']");
    if (saveBtn) saveBtn.style.display = "inline-block";
}
