import React from 'react';
import ReactDOM from "react-dom/client";
import AddModal from "../Modal/AddModal";

function AddHotelButton() {
    return (
        <div className="container">
            <button
                type="button"
                className="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#addModal"
            >Add New</button>
            <AddModal />

        </div>
    );
}
export default AddHotelButton;
if (document.getElementById('add-hotel')) {
    ReactDOM.createRoot(document.getElementById('add-hotel')).render(<AddHotelButton />);
}
