import QtQuick 2.15
import QtQuick.Window 2.15
import QtQuick.Layouts 1.3
import QtQuick.Controls
Window {
    id:win
    minimumWidth: 360
    minimumHeight: 600
    visible: true
    title: qsTr("Hello World")
    Rectangle{

        anchors.fill:  parent
        color: "#F0F0F0"

        ColumnLayout{


            anchors.centerIn: parent
            spacing: 5
            id: container
            width:  parent.width / 2
            height: parent.height /2

            TextField{
                Layout.alignment: Qt.AlignCenter
                Layout.fillWidth: true
                id: usernameField
                placeholderText: "Username"
                font.pixelSize: 16
                background: Rectangle {
                    implicitWidth: 100
                    implicitHeight: 30
                    border.color: "#26282a"
                }

            }
            TextField{
                Layout.alignment: Qt.AlignCenter
                Layout.fillWidth: true
                id: passwordField
                placeholderText: "Password"
                font.pixelSize: 16
                echoMode: TextInput.Password
                background: Rectangle {
                    implicitWidth: 200
                    implicitHeight: 30
                    border.color: "#26282a"

                }
            }
            Item{
                height: 50
                Layout.fillWidth: true
                RowLayout{
                    anchors.fill:  parent
                    spacing:5
                    Button{
                        text: "Log in"
                        hoverEnabled: false
                        background: Rectangle {
                            implicitWidth: container.width /2 - 2.5
                            implicitHeight: 40
                            color: parent.down ? "#d6d6d6" : "#b5b5b5"
                            border.color: "#26282a"
                            border.width:  parent.down ? 1 : 0
                            radius: 2
                        }
                        contentItem: Text {
                            text: parent.text
                            font: parent.font
                            opacity: enabled ? 1.0 : 0.3
                            horizontalAlignment: Text.AlignHCenter
                            verticalAlignment: Text.AlignVCenter
                            elide: Text.ElideRight
                        }

                    }
                    Button{
                        text: "Clear"
                        hoverEnabled: false
                        onPressed: {usernameField.text = "";passwordField.text = ""}
                        background: Rectangle {
                            implicitWidth: container.width /2 - 2.5
                            implicitHeight: 40
                            color: parent.down ? "#d6d6d6" : "#F0F0F0"
                            border.color: "#26282a"
                            border.width:  parent.down ? 1 : 0
                            radius: 2
                        }
                        contentItem: Text {
                            text: parent.text
                            font: parent.font
                            horizontalAlignment: Text.AlignHCenter
                            verticalAlignment: Text.AlignVCenter
                            elide: Text.ElideRight
                        }
                    }
                }
            }

            Item{
                Layout.fillHeight: parent
            }
        }

    }

}
