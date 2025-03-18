import React from 'react';
import ReactDOM from 'react-dom/client'; // React 18 uses 'react-dom/client'

const App = () => {
    return (
        <div>
            <h1>Welcome to React inside Laravel</h1>
        </div>
    );
};

// Using React 18 root API
const root = ReactDOM.createRoot(document.getElementById('app'));
root.render(<App />);
