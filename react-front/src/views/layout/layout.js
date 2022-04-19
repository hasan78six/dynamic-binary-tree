import React from "react";

const Layout = ({ children }) => {
    return (
        <div>
            <div className="row justify-content-center">
                <div className="col-md-12">
                    {children}
                </div>
            </div>
        </div>
    );
};

export default Layout;
