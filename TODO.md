# TODO: Fix Notifications

## Tasks

-   [ ] Create PesananStatusUpdated notification for users when admin updates order status
-   [ ] Create PesananCreated notification for users when order is created
-   [ ] Modify BeritaCreated to send to all users instead of just admins
-   [ ] Modify ProductUpdated to send to all users instead of just admins
-   [ ] Update checkoutController to send PesananCreated notification to user and PesananBaru to admin
-   [ ] Update PesananResource to send PesananStatusUpdated notification on status update
-   [ ] Update CreateProduk.php to send ProductUpdated to all users
-   [ ] Update beritaController.php to send BeritaCreated to all users
-   [ ] Test notifications by creating a product, news, order, and updating order status

## Berita Approval System

### Completed Tasks

-   [x] Add status column to berita table (migration: 2025_11_08_173637_add_status_to_berita_table.php)
-   [x] Update Berita model to include status field
-   [x] Add approve and reject actions to BeritaResource in Filament admin panel
-   [x] Create BeritaStatusUpdated notification class
-   [x] Update BeritaController to only show approved berita on public pages
-   [x] Update penulis/beritaController to set default status to 'pending' for new berita
-   [x] Update penulis berita view to show status badges (Disetujui/Menunggu/Ditolak)
-   [x] Update penulis berita view to show correct status counts in dashboard
-   [x] Update penulis berita form to remove status selection and add info note about approval process

### Pending Tasks

-   [ ] Test the approval workflow by creating a berita and approving/rejecting it
-   [ ] Ensure notifications are sent correctly to penulis when status changes
-   [ ] Update any other views that might need status filtering
