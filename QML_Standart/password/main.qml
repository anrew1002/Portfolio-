import QtQuick 2.15
import QtQuick.Window 2.15
import QtQuick.Controls
import QtQuick.Layouts 1.3

Window {
    minimumWidth: 360
    minimumHeight: 600
    visible: true
    title: qsTr("Hello World")
    Rectangle{
        color: "white"
        anchors.fill: parent
        ColumnLayout{
            anchors.fill:parent
            TextField{
                id: passwordField
                text: passwordField.text
                opacity: 0
            }

            Text {
                text: "Enter your password:"
                font.pixelSize: 16
                Layout.alignment: Qt.AlignCenter

            }
            Rectangle {
                id: passwordField1
                color: "white"
                border.width: 2
                border.color: "black"
                width: parent.width
                height: 50
                Layout.alignment: Qt.AlignCenter
                Row {
                    spacing: 6
                    anchors.centerIn: parent
                    // Добавляем 6 элементов Label для отображения введенных символов
                    Repeater {
                        model:6
                        Label {
                            width: 20
                            height: 20
                            font.pixelSize: 36
                            text: "*"
                            Layout.alignment: Qt.AlignCenter
                            color:index <passwordField.text.length ? "black" : "light grey"
                        }
                    }
                }
            }

            GridLayout {
                id: keypad
                rows: 4
                columns: 3
                width: parent.width
                Layout.alignment: Qt.AlignCenter
                Button {

                    text: "1"
                    onClicked: passwordField.text += "1"
                    background: Rectangle {
                        implicitWidth: 60
                        implicitHeight: 40
                        opacity: enabled ? 1 : 0.3
                        border.color: "#C1BCC0"
                        border.width: 1
                        radius: 2
                    }


                }
                Button {
                    text: "2"
                    onClicked: passwordField.text+= "1"
                    background: Rectangle {
                        implicitWidth: 60
                        implicitHeight: 40
                        opacity: enabled ? 1 : 0.3
                        border.color: "#C1BCC0"
                        border.width: 1
                        radius: 2
                    }
                }
                Button {
                    text: "3"
                    onClicked: passwordField.text+= "1"
                    background: Rectangle {
                        implicitWidth: 60
                        implicitHeight: 40
                        opacity: enabled ? 1 : 0.3
                        border.color: "#C1BCC0"
                        border.width: 1
                        radius: 2
                    }
                }
                Button {
                    text: "4"
                    onClicked: passwordField.text+= "1"
                    background: Rectangle {
                        implicitWidth: 60
                        implicitHeight: 40
                        opacity: enabled ? 1 : 0.3
                        border.color: "#C1BCC0"
                        border.width: 1
                        radius: 2
                    }
                }
                Button {
                    text: "5"
                    onClicked: passwordField.text+= "1"
                    background: Rectangle {
                        implicitWidth: 60
                        implicitHeight: 40
                        opacity: enabled ? 1 : 0.3
                        border.color: "#C1BCC0"
                        border.width: 1
                        radius: 2
                    }
                }
                Button {
                    text: "6"
                    onClicked: passwordField.text+= "1"
                    background: Rectangle {
                        implicitWidth: 60
                        implicitHeight: 40
                        opacity: enabled ? 1 : 0.3
                        border.color: "#C1BCC0"
                        border.width: 1
                        radius: 2
                    }
                }
                Button {
                    text: "7"
                    onClicked: passwordField.text+= "1"
                    background: Rectangle {
                        implicitWidth: 60
                        implicitHeight: 40
                        opacity: enabled ? 1 : 0.3
                        border.color: "#C1BCC0"
                        border.width: 1
                        radius: 2
                    }
                }
                Button {
                    text: "8"
                    onClicked: passwordField.text+= "1"
                    background: Rectangle {
                        implicitWidth: 60
                        implicitHeight: 40
                        opacity: enabled ? 1 : 0.3
                        border.color: "#C1BCC0"
                        border.width: 1
                        radius: 2
                    }
                }
                Button {
                    text: "9"
                    onClicked: passwordField.text+= "1"
                    background: Rectangle {
                        implicitWidth: 60
                        implicitHeight: 40
                        opacity: enabled ? 1 : 0.3
                        border.color: "#C1BCC0"
                        border.width: 1
                        radius: 2
                    }
                }
                Button {
                    text: ""
                    enabled: false
                    background: Rectangle {
                        implicitWidth: 60
                        implicitHeight: 40
                        opacity: enabled ? 1 : 0.3
                        border.color: "#C1BCC0"
                        border.width: 1
                        radius: 2
                    }
                }
                Button {
                    text: "0"
                    onClicked: passwordField.text+= "1"
                    background: Rectangle {
                        implicitWidth: 60
                        implicitHeight: 40
                        opacity: enabled ? 1 : 0.3
                        border.color: "#C1BCC0"
                        border.width: 1
                        radius: 2
                    }
                }
                Button {
                    text: "Clear"
                    onClicked: passwordField.text = ""
                    background: Rectangle {
                        implicitWidth: 60
                        implicitHeight: 40
                        opacity: enabled ? 1 : 0.3
                        border.color: "#C1BCC0"
                        border.width: 1
                        radius: 2
                    }
                }
            }


        }
    }
}
