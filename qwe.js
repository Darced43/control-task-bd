class Qwe {
    constructor(name, lastName) {
        this.name = name;
        this.lastName = lastName;
    }

    getFullName() {
        return `${this.name} ${this.lastName}`;
    }
}

const qwe = new Qwe('Hui', 'pizda');

console.log(`${qwe.name} ${qwe.lastName}`);

console.log(qwe.getFullName());

const obj = {
    qwe: 123,
    qwe() {
        return 'qwe';
    }
}

const asf = ['qwe', 'qwer'];

console.log(asf[0])