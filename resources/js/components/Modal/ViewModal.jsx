import React, { Component } from 'react';

class ViewModal extends Component {
    constructor(props) {
        super(props);
        this.state = {
            lat: null,
            long: null,
            address: null
        }
    }

    render() {
        return (
            <div className="modal fade" id={"viewModal" + this.props.modalId} tabIndex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                <div className="modal-dialog">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h5 className="modal-title" id="viewModalLabel"> {this.props.hotelInfo.hotelName}</h5>
                            <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div className="modal-body">
                            Name: <strong>{ this.props.hotelInfo.hotelName}</strong>
                            <hr />
                            Address: <strong>{ this.props.hotelInfo.hotelAddress}, {this.props.hotelInfo.hotelCity}.</strong>
                            <hr />
                            <img width="450px" className="rounded mx-auto d-block" src={this.props.hotelInfo.hotelImage} alt={this.props.hotelInfo.hotelName + "--image"}/>
                            <hr />
                            Description: <strong>{ this.props.hotelInfo.hotelDescription}</strong>
                            <hr />
                            Star: <strong>{ this.props.hotelInfo.hotelStar}</strong>
                        </div>
                        <div className="modal-footer">
                            <button type="button" className="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}
export default ViewModal
