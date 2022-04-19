import { useEffect, useState } from "react";
import BinaryTree from "react-d3-tree";
import Config from "../../config/config"

const Tree = (props) => {
    const [items, setItems] = useState({});

    useEffect(() => {
        fetch(Config.api_base_url + "get-user", {
            method: "POST",
            headers: new Headers({
                Authorization:
                    "Bearer " + Config.bearer_token,
                Accept: "application/json",
            }),
            body: '{"sponsor_username": "binary"}',
        })
            .then((res) => res.json())
            .then((json) => {
                let data = {
                    name: "(MLM) Binary Tree",
                    children: json.data,
                };
                
                setItems(data);
            });
    }, []);

    return (
        <div
            id="treeWrapper"
            style={{ width: window.innerWidth, height: window.innerHeight }}
        >
            <BinaryTree
                data={items}
                orientation="vertical"
                zoomable={true}
                zoom={1}
                collapsible={true}
                enableLegacyTransitions={true}
                translate={{ x: window.innerWidth / 2, y: 100 }}
                pathFunc="straight"
                initialDepth={4}
            />
        </div>
    );
};

export default Tree;
