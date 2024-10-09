import React, { Component } from 'react';
import {toast} from "react-toastify";

class DeleteModal extends Component {
    constructor(props) {
        super(props);
    }

    /**
     * Send axios call to backend to delete specific record
     */
    deleteItem = () => {
        axios.delete(`home/delete-hotel/${this.props.modalId}`).then( () => {
            toast.success('One item has been deleted');
            setTimeout(() => {
                location.reload();
            }, 1500)
        })
    }
    render() {
        return (
            <div className="modal fade" id={"deleteModal" + this.props.modalId} tabIndex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div className="modal-dialog">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h5 className="modal-title" id="deleteModalLabel">Delete Item</h5>
                            <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div className="modal-body">
                            Are you sure you want to delete this item
                        </div>
                        <div className="modal-footer">
                            <button
                                style={{ marginRight: "auto" }}
                                type="button"
                                className="btn btn-danger"
                                data-bs-dismiss="modal"
                                onClick={this.deleteItem}
                            >Yes
                            </button>
                            <button type="button" className="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}
export default DeleteModal
