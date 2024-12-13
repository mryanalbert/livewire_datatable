import './bootstrap';
import 'flowbite';

// Define the Alpine.js component
function deleteUserModal() {
    return {
        open: false,
        userIdToDelete: null,
        openModal(userId) {
            this.userIdToDelete = userId;
            this.open = true;
        },
        closeModal() {
            this.open = false;
            this.userIdToDelete = null;
        },
        confirmDelete() {
            // Assuming $wire is available for handling the delete action (typically with Livewire)
            $wire.deleteUser(this.userIdToDelete);
            this.closeModal();
        }
    };
}
