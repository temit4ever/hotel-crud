import React from 'react';
import ReactDOM from 'react-dom/client';
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
// The first Entry point from the blade(Home.blade.php) into react
if (document.getElementById('views')) {
    ReactDOM.createRoot(document.getElementById('views')).render(<HotelList />);
}
