import React from 'react';
import ReactDOM from 'react-dom/client';
import { BrowserRouter, Routes, Route, Link } from 'react-router-dom';
import Home from './home';
import RandomTester from './test';

// Template Components (you'll need to create these)
import TemplateList from './components/templates/TemplateList';
import TemplateCreate from './components/templates/TemplateCreate';
import TemplateEdit from './components/templates/TemplateEdit';
import TemplateShow from './components/templates/TemplateShow';

// Record Components (you'll need to create these)
import RecordList from './components/records/RecordList';
import RecordCreate from './components/records/RecordCreate';
import RecordEdit from './components/records/RecordEdit';
import RecordShow from './components/records/RecordShow';

const App = () => {
    return (
        <BrowserRouter>
            <div className="min-h-screen bg-gray-100">
                <nav className="bg-white shadow-sm p-4">
                    <div className="container mx-auto flex justify-between items-center">
                        <div className="text-xl font-bold">Medical Records</div>
                        <div className="space-x-4">
                            <Link to="/" className="hover:text-blue-500">Home</Link>
                            <Link to="/templates" className="hover:text-blue-500">Templates</Link>
                            <Link to="/records" className="hover:text-blue-500">Records</Link>
                            <Link to="/test" className="hover:text-blue-500">Test</Link>
                        </div>
                    </div>
                </nav>

                <main className="container mx-auto p-4">
                    <Routes>
                        {/* Home Route */}
                        <Route path="/" element={<Home />} />

                        {/* Test Route */}
                        <Route path="/test" element={<RandomTester />} />

                        {/* Template Routes */}
                        <Route path="/templates" element={<TemplateList />} />
                        <Route path="/templates/create" element={<TemplateCreate />} />
                        <Route path="/templates/:id" element={<TemplateShow />} />
                        <Route path="/templates/:id/edit" element={<TemplateEdit />} />

                        {/* Record Routes */}
                        <Route path="/records" element={<RecordList />} />
                        <Route path="/templates/:templateId/records/create" element={<RecordCreate />} />
                        <Route path="/records/:id" element={<RecordShow />} />
                        <Route path="/records/:id/edit" element={<RecordEdit />} />
                    </Routes>
                </main>
            </div>
        </BrowserRouter>
    );
};

// Using React 18 root API
const root = ReactDOM.createRoot(document.getElementById('app'));
root.render(<App />);
