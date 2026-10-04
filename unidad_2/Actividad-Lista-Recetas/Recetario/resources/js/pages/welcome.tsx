import { Head, Link, usePage } from '@inertiajs/react';
import { Button, Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@pikoloo/darwin-ui';

export default function Welcome() {
    return (
        <Card>
            <CardHeader>
                <CardTitle>Card Title</CardTitle>
                <CardDescription>Description</CardDescription>
            </CardHeader>
            <CardContent>Content here</CardContent>
            <CardFooter>
                <Button>Action</Button>
            </CardFooter>
        </Card>
    );
}
