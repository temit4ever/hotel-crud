import React from 'react';
import ReactDOM from 'react-dom';
import Table from './HotelList/Table'

function HotelList() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <Table />
            </div>
        </div>
    );
}
export default HotelList;
if (document.getElementById('views')) {
    ReactDOM.render(<HotelList />, document.getElementById('views'));
}
