# Mini CRM 

A lightweight CRM system designed for SMEs in Malaysia.
Includes essential CRM modules: Users, Roles, Products, Leads, Clients, Deals (Pipeline), Tasks, Activity Logs, and Dashboard.

---

## 📌 Core Modules

### 1. User & Role Management

- [ ] User login/logout
- [ ] Roles: Admin, Salesperson, Sales Manager
- [ ] Admin manages all modules
- [ ] Salesperson sees only their own leads & deals
- [ ] User CRUD (Admin only)
- [ ] User profile page

### 2. Product / Catalogue Management

- [ ] Product list
- [ ] Add / edit / delete product
- [ ] Product fields: name, price, description
- [ ] Products can be added to Deals (deal_items)

### 3. Leads Management

- [ ] Add new lead
- [ ] Lead list & search
- [ ] Lead statuses: New, Contacted, Qualified, Not Interested
- [ ] Lead details page
- [ ] Lead activity logs (notes, calls, follow-ups)
- [ ] Convert Lead → Client

### 4. Clients (Customers)

- [ ] Client list & search
- [ ] Add / edit client
- [ ] Client details page
- [ ] View linked deals

### 5. Deals (Sales Pipeline)

- [ ] Create new deal (attached to a client)
- [ ] Deal stages: New → Contacted → Meeting → Proposal → Negotiation → Won/Lost
- [ ] Kanban pipeline board
- [ ] Deal details page
- [ ] Deal activity logs
- [ ] Add products to a deal
- [ ] Auto-calculate deal value based on selected products

### 6. Tasks (Follow-ups)

- [ ] Create task (call, meeting, follow-up)
- [ ] Assign to Lead or Deal
- [ ] Due date & reminder
- [ ] Mark as completed
- [ ] Task list: Today, Upcoming, Completed

### 7. Dashboard

- [ ] Total leads
- [ ] Pipeline summary
- [ ] Today’s tasks
- [ ] Recent activity

---

## 🧱 Build Roadmap (Correct Sequential Order)

### Phase 1 – Foundation

- [ ] Project setup
- [ ] Authentication
- [ ] Roles & permissions
- [ ] User CRUD
- [ ] Base UI layout

### Phase 2 – Product Catalogue

- [ ] Product CRUD
- [ ] Product listing page
- [ ] Product detail page

### Phase 3 – Leads Module

- [ ] Leads CRUD
- [ ] Status workflow
- [ ] Lead details view
- [ ] Lead activity logs
- [ ] Convert Lead → Client

### Phase 4 – Clients Module

- [ ] Client CRUD
- [ ] Client details page
- [ ] Attach converted leads to clients

### Phase 5 – Deals & Sales Pipeline

- [ ] Deal CRUD
- [ ] Pipeline stages
- [ ] Kanban board
- [ ] Deal details view
- [ ] Deal activity logs
- [ ] Add products to deals
- [ ] Calculate deal value

### Phase 6 – Tasks System

- [ ] Create tasks (lead or deal)
- [ ] Task listing + filtering
- [ ] Mark tasks completed

### Phase 7 – Dashboard

- [ ] Lead KPIs
- [ ] Sales pipeline summary
- [ ] Tasks overview
- [ ] Recent logarithmic activity feed

### Phase 8 – Final Polish

- [ ] UI improvements
- [ ] Permission enforcement
- [ ] Ownership checks
- [ ] Final testing & refinements

---

## 📅 Future Enhancements (Optional)

- [ ] Quotation module (using deal products)
- [ ] Invoice / Billing module
- [ ] Reports & analytics
- [ ] WhatsApp / Email integration
