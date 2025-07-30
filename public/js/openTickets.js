document.addEventListener("DOMContentLoaded", () => {
    loadOpenTickets();
});

function loadOpenTickets() {
    fetch(fetchRoute)
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById("ticketBody");
            const count = document.getElementById("open-count");
            tbody.innerHTML = "";
            if (count) count.textContent = data.length;

            data.forEach(ticket => {
                tbody.innerHTML += `
                    <tr data-id="${ticket.id}">
                        <td>#${ticket.id}</td>
                        <td>${ticket.name}</td>
                        <td>${ticket.subject}</td>
                        <td><span class="status-badge">${ticket.status}</span></td>
                        <td>${ticket.priority}</td>
                        <td>
                            <select onchange="updateStatus(${ticket.id}, this)">
                                ${generateOptions(ticket.status)}
                            </select>
                        </td>
                        <td>
                            ${ticket.media_path
                                ? `<a href="${ticket.media_path}" target="_blank">${ticket.media_path.includes('.mp4') ? '🎥 Video' : '🖼️ Image'}</a>`
                                : 'No Media'}
                        </td>
                        <td>
                            ${ticket.location_url
                                ? `<a href="${ticket.location_url}" target="_blank">📍 View</a>`
                                : 'No Location'}
                        </td>
                    </tr>
                `;
            });
        });
}

function generateOptions(currentStatus) {
    const statuses = ['opend', 'visiting site', 'in progress', 'completed', 'closed'];
    return statuses.map(status =>
        `<option value="${status}" ${status === currentStatus ? 'selected' : ''}>${capitalize(status)}</option>`
    ).join('');
}

function capitalize(text) {
    return text.charAt(0).toUpperCase() + text.slice(1);
}

function updateStatus(ticketId, selectEl) {
    const newStatus = selectEl.value;

    fetch(updateRoute, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken
        },
        body: JSON.stringify({
            id: ticketId,
            status: newStatus
        })
    })
    .then(res => res.json())
    .then(() => {
        loadOpenTickets(); // refresh to update table display
    })
    .catch(err => {
        console.error("Status update failed", err);
        alert("Failed to update status");
    });
}
