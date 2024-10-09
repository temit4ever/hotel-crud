import React, { Component } from 'react';
import TableActionButtons from "./TableActionButtons";

class TableRow extends Component {
    constructor(props) {
        super(props)
    }
    render() {
        return (
            <tr>
                <td>{this.props.hotel.hotel_name}</td>
                <td>
                    <img width="150px" className="rounded mx-auto" src={this.props.hotel.image} alt={this.props.hotel.hotel_name + "--image"}/>
                </td>
                <td>{this.props.hotel.city}</td>
                <td>{this.props.hotel.stars}</td>
                <td>
                    <TableActionButtons id={this.props.hotel.id}/>
                </td>
            </tr>
        )
    }
}
 export default TableRow
